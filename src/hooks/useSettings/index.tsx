import { useEffect, useState } from "react";

import { PluginSettings, SettingValue } from "../../types/settings";
import usePluginSettingsQuery from "../../hooks/api/queries/usePluginSettingsQuery";
import usePluginSettingsMutation from "../../hooks/api/mutations/usePluginSettingsMutation";

interface UseSettingsReturn {
  settings: PluginSettings;
  isErrorSaving: boolean;
  isErrorFetching: boolean;
  getSetting: (key: string) => string;
  saveSetting: (key: string, value: SettingValue) => void;
  saveSettings: () => void;
}

const useSettings = (): UseSettingsReturn => {
  const [settings, setSettings] = useState<PluginSettings>({ 'sample-setting': '' });
  const { mutate: dbSaveSettings, isError: isErrorSaving } = usePluginSettingsMutation();
  const { data: dbSettings, isError: isErrorFetching } = usePluginSettingsQuery();

  const saveSettings = () => {
    dbSaveSettings(settings);
  };

  const getSetting = (key: string): string => {
    const value = settings[key];
    return typeof value === 'string' ? value : String(value ?? '');
  };

  const saveSetting = (key: string, value: SettingValue) => {
    setSettings((prevSettings) => ({
      ...prevSettings,
      [key]: value,
    }));
  };

  useEffect(() => {
    if (dbSettings) {
      setSettings(dbSettings);
    }
  }, [dbSettings]);

  return {
    settings,
    isErrorSaving,
    isErrorFetching,
    getSetting,
    saveSetting,
    saveSettings
  };
};

export default useSettings;
