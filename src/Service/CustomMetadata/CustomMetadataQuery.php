<?php

namespace FluxIliasRestApi\Service\CustomMetadata;

use Exception;
use FluxIliasBaseApi\Adapter\CustomMetadata\CustomMetadataDto;
use ilADT;
use ilADTEnum;
use ilADTFloat;
use ilADTInteger;
use ilADTLocalizedText;
use ilADTMultiEnum;
use ilADTText;
use ilAdvancedMDFieldDefinition;
use ilAdvancedMDRecord;
use ilAdvancedMDValues;
use LogicException;

trait CustomMetadataQuery
{

    /**
     * @return CustomMetadataDto[]
     */
    private function getCustomMetadata(int $object_id) : array
    {
        $custom_metadata = [];

        foreach (ilAdvancedMDValues::getInstancesForObjectId($object_id) as $md_values) {
            $md_values->read();

            foreach ($md_values->getADTGroup()->getElements() as $field_id => $md_element) {
                $md_definition = $md_values->getDefinitions()[$field_id];

                $custom_metadata[] = CustomMetadataDto::new(
                    $field_id,
                    $md_definition->getTitle(),
                    $md_definition->getRecordId(),
                    ilAdvancedMDRecord::_lookupTitle($md_definition->getRecordId()),
                    $this->getCustomMetadataElementValue(
                        $md_element,
                        $md_definition
                    ),
                    CustomMetadataFieldTypeMapping::mapInternalToExternal(CustomInternalCustomMetadataFieldType::factory(
                        $md_definition->getType()
                    ))
                );
            }
        }

        return $custom_metadata;
    }


    private function getCustomMetadataElementEnumValue(array $options, mixed $index) : array
    {
        if (is_string($index) && is_numeric($index)) {
            $index = floatval($index);
        }

        return ["index" => $index, "title" => $options[$index] ?? null];
    }


    private function getCustomMetadataElementValue(ilADT $md_element, ilAdvancedMDFieldDefinition $md_definition) : mixed
    {
        switch (true) {
            case $md_element instanceof ilADTLocalizedText:
                $value = [
                    "_" => $this->normalizeCustomMetadataText(
                        $md_element->getText()
                    )
                ];

                foreach ($md_element->getCopyOfDefinition()->getActiveLanguages() as $language) {
                    $value[$language] = $this->normalizeCustomMetadataText(
                        $md_element->getTranslations()[$language]
                    );
                }

                return $value;

            case $md_element instanceof ilADTText:
                return $this->normalizeCustomMetadataText(
                    $md_element->getText()
                );

            case $md_element instanceof ilADTInteger:
            case $md_element instanceof ilADTFloat:
                return $md_element->getNumber();

            case $md_element instanceof ilADTEnum:
                return $md_element->getSelection() !== null ? $this->getCustomMetadataElementEnumValue(
                    $md_definition->getOptions(),
                    $md_element->getSelection()
                ) : null;

            case $md_element instanceof ilADTMultiEnum:
                return array_map(fn(mixed $index) : array => $this->getCustomMetadataElementEnumValue(
                    $md_definition->getOptions(),
                    $index
                ), $md_element->getSelections() ?? []);

            default:
                return null;
        }
    }


    private function normalizeCustomMetadataText(mixed $text) : string
    {
        return str_replace("\r", "\n", str_replace("\r\n", "\n", strval($text)));
    }


    private function setCustomMetadataElementEnumValue(array $options, mixed $index) : mixed
    {
        if (is_object($index)) {
            $index = (array) $index;
        }

        if (is_array($index)) {
            $title = $index["title"] ?? null;
            $index = $index["index"] ?? null;
        } else {
            if (!is_int($index) && !is_float($index) && !(is_string($index) && is_numeric($index))) {
                $title = $index;
                $index = null;
            } else {
                $title = null;
            }
        }

        if ($title !== null) {
            if ($index !== null) {
                throw new LogicException("Can't set both option title and index");
            }

            $index = array_flip($options)[$title] ?? null;
            if ($index === null) {
                throw new Exception("Option title " . $title . " does not exists");
            }
        }

        if (!array_key_exists($index, $options)) {
            throw new Exception("Option index " . $index . " does not exists");
        }

        if (is_string($index) && is_numeric($index)) {
            $index = floatval($index);
        }

        return $index;
    }


    private function setCustomMetadataElementValue(ilADT $md_element, ilAdvancedMDFieldDefinition $md_definition, mixed $value) : void
    {
        switch (true) {
            case $md_element instanceof ilADTLocalizedText:
                if (is_object($value)) {
                    $value = (array) $value;
                }

                if (!is_array($value)) {
                    $value = [
                        "_" => $value
                    ];
                }

                $md_adt_definition = $md_element->getCopyOfDefinition();

                if (array_key_exists("_", $value)) {
                    $default_value = $value["_"];
                } else {
                    if (array_key_exists($md_adt_definition->getDefaultLanguage(), $value)) {
                        $default_value = $value[$md_adt_definition->getDefaultLanguage()];
                    } else {
                        $default_value = $value[array_key_first($value)] ?? null;
                    }
                }
                $md_element->setText($this->normalizeCustomMetadataText(
                    $default_value
                ));

                foreach ($md_adt_definition->getActiveLanguages() as $language) {
                    if (array_key_exists($language, $value)) {
                        $md_element->setTranslation($language, $this->normalizeCustomMetadataText(
                            $value[$language]
                        ));
                    } else {
                        $md_element->setTranslation($language, $this->normalizeCustomMetadataText(
                            $default_value
                        ));
                    }
                }
                break;

            case $md_element instanceof ilADTText:
                $md_element->setText($this->normalizeCustomMetadataText(
                    $value
                ));
                break;

            case $md_element instanceof ilADTInteger:
            case $md_element instanceof ilADTFloat:
                $md_element->setNumber($value);
                break;

            case $md_element instanceof ilADTEnum:
                $md_element->setSelection($value !== null ? $this->setCustomMetadataElementEnumValue(
                    $md_definition->getOptions(),
                    $value
                ) : null);
                break;

            case $md_element instanceof ilADTMultiEnum:
                $value ??= [];
                if (!is_array($value)) {
                    $value = [$value];
                }
                $md_element->setSelections(array_map(fn(mixed $index) : mixed => $this->setCustomMetadataElementEnumValue(
                    $md_definition->getOptions(),
                    $index
                ), $value));
                break;

            default:
                throw new Exception("Custom metadata field type " . get_class($md_element) . " not supported");
        }
    }


    /**
     * @param CustomMetadataDto[] $custom_metadata
     */
    private function updateCustomMetadata(int $object_id, array $custom_metadata) : void
    {
        $fields = null;

        foreach ($custom_metadata as $custom_metadata_field) {
            $fields ??= $this->getCustomMetadata($object_id);

            if ($custom_metadata_field->record_title !== null) {
                if ($custom_metadata_field->record_id !== null) {
                    throw new LogicException("Can't set both custom metadata record title and record id");
                }

                $record_titles = array_values(array_reduce(array_filter($fields, fn(CustomMetadataDto $field) : bool => $field->record_title === $custom_metadata_field->record_title),
                    function (array $fields, CustomMetadataDto $field) : array {
                        $fields[$field->record_id] = $field;

                        return $fields;
                    }, []));
                if (empty($record_titles)) {
                    throw new Exception("Custom metadata record title " . $custom_metadata_field->record_title . " does not exists");
                }
                if (count($record_titles) > 1) {
                    throw new LogicException("Multiple custom metadata record titles " . $custom_metadata_field->record_title . " found");
                }
                $record_title = current($record_titles);

                $record_id = $record_title->getRecordId();
            } else {
                $record_id = $custom_metadata_field->record_id;

                if ($record_id !== null) {
                    $record_ids = array_filter($fields, fn(CustomMetadataDto $field) : bool => $field->record_id === $record_id);
                    if (empty($record_ids)) {
                        throw new Exception("Custom metadata record id " . $record_id . " does not exists");
                    }
                }
            }

            if ($custom_metadata_field->field_title !== null) {
                if ($custom_metadata_field->field_id !== null) {
                    throw new LogicException("Can't set both custom metadata field title and field id");
                }

                $field_titles = array_filter($fields,
                    fn(CustomMetadataDto $field) : bool => ($record_id === null || $field->record_id === $record_id) && $field->field_title === $custom_metadata_field->field_title);
                if (empty($field_titles)) {
                    throw new Exception("Custom metadata field title " . $custom_metadata_field->field_title . ($record_id !== null ? " in record id " . $record_id : "") . " does not exists");
                }
                if (count($field_titles) > 1) {
                    if ($record_id !== null) {
                        throw new LogicException("Multiple custom metadata field titles " . $custom_metadata_field->field_title
                            . " in record id " . $record_id . " found");
                    } else {
                        throw new LogicException("Multiple custom metadata field titles " . $custom_metadata_field->field_title
                            . " found - Try additionally to set record title or record id");
                    }
                }
                $field_title = current($field_titles);

                $field_id = $field_title->getFieldId();

                if ($record_id === null) {
                    $record_id = $field_title->getRecordId();
                }
            } else {
                $field_id = $custom_metadata_field->field_id;

                if ($field_id !== null) {
                    $field_ids = array_filter($fields, fn(CustomMetadataDto $field) : bool => $field->field_id === $field_id);
                    if (empty($field_ids)) {
                        throw new Exception("Custom metadata field id " . $field_id . " does not exists");
                    }

                    if ($record_id === null) {
                        $record_id = current($field_ids)->getRecordId();
                    }
                } else {
                    throw new LogicException("Either set custom metadata field title or field id");
                }
            }

            $md_values = new ilAdvancedMDValues($record_id, $object_id);

            $md_values->read();

            $this->setCustomMetadataElementValue(
                $md_values->getADTGroup()->getElement($field_id),
                $md_values->getDefinitions()[$field_id],
                $custom_metadata_field->value
            );

            $md_values->write();
        }
    }
}
