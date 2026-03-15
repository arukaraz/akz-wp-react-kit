export type SettingValue = string | boolean | number;

export interface PluginSettings {
  'sample-setting': string;
  [key: string]: SettingValue;
}
