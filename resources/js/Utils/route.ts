import { route as ziggyRoute } from "ziggy-js";

export function route(name: string, params?: any) {
  try {
    return ziggyRoute(name, params);
  } catch (error) {
    console.error(`Route ${name} not found.`);

    return ziggyRoute("404", "/not-found");
  }
}

export function currentRoute(name: string) {
  return ziggyRoute().current(name);
}
