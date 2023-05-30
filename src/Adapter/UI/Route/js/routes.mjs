import { FluxLoadingSpinnerElement } from "../../../../flux-ilias-rest-web-proxy/ui/Libs/flux-loading-spinner/src/FluxLoadingSpinnerElement.mjs";
import { getRoutes } from "./fetch/getRoutes.mjs";
import { initContentTypeList } from "./list/initContentTypeList.mjs";
import { initParamList } from "./list/initParamList.mjs";
import { initResponseList } from "./list/initResponseList.mjs";
import { insertError } from "./loading/insertError.mjs";

async function routes() {
    const el = document.getElementById("routes");

    const flux_loading_spinner_element = FluxLoadingSpinnerElement.new();
    el.appendChild(flux_loading_spinner_element);

    let routes;
    try {
        routes = await getRoutes();
    } catch (err) {
        insertError(err, "Routes could not be loaded", el);
        return;
    } finally {
        flux_loading_spinner_element.remove();
    }

    const routes_template_el = el.querySelector("[data-routes-template]");
    const routes_el = routes_template_el.content.firstElementChild.cloneNode(true);

    const route_template_el = routes_el.querySelector("[data-route-template]");
    route_template_el.remove();

    const param_template_el = routes_el.querySelector("[data-param-template]");
    param_template_el.remove();

    const content_type_template_el = routes_el.querySelector("[data-content-type-template]");
    content_type_template_el.remove();

    const response_template_el = routes_el.querySelector("[data-response-template]");
    response_template_el.remove();

    for (const route of routes) {
        const route_el = route_template_el.content.firstElementChild.cloneNode(true);

        route_el.dataset.route = route.route;

        route_el.querySelector("[data-method]").innerText = route.method;
        route_el.querySelector("[data-route]").innerText = route.route;
        route_el.querySelector("[data-title]").innerText = route.title;
        route_el.querySelector("[data-description]").innerText = route.description;

        initParamList(param_template_el, route.route_params, route_el.querySelector("[data-route-params]"));
        initParamList(param_template_el, route.query_params, route_el.querySelector("[data-query-params]"));

        initContentTypeList(content_type_template_el, route.content_types, route_el.querySelector("[data-content-types]"));

        initResponseList(response_template_el, route.responses, route_el.querySelector("[data-responses]"));

        const details_el = route_el.querySelector("details");
        details_el.addEventListener("toggle", () => {
            if (details_el.open) {
                history.replaceState(null, null, `#${route.route}`);
            } else {
                history.replaceState(null, null, " ");
            }
        });

        routes_el.appendChild(route_el);
    }

    routes_template_el.replaceWith(routes_el);

    addEventListener("hashchange", changedHash);
    changedHash();

    function changedHash() {
        const route = location.hash.substring(1);
        if (route.length > 0) {

            const route_el = routes_el.querySelector(`[data-route="${route}"]`);
            if (route_el !== null) {

                route_el.scrollIntoView({ block: "nearest", inline: "nearest" });
                route_el.querySelector("details").open = true;
            }
        }
    }
}

await routes();
