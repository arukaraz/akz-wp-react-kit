export const API_BASEURL: string = `/${AkzWpReactKitLocalize.plugin_page_name}/v1`;
export const PLUGIN_FRIENDLY_NAME: string = AkzWpReactKitLocalize.plugin_page_name
              .replace(/[-_]/g, ' ')
              .replace(/\b\w/g, (char: string) => char.toUpperCase());
