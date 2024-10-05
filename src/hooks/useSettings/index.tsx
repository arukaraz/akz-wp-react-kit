import {__} from "@wordpress/i18n";
import { useEffect, useState } from "react";

import usePluginSettingsQuery from "../../hooks/api/queries/usePluginSettingsQuery";
import usePluginSettingsMutation from "../../hooks/api/mutations/usePluginSettingsMutation";

interface Settings {
  [key: string]: any;
}

interface UseSettingsReturn {
  settings: Settings;
  isErrorSaving: boolean;
  isErrorFetching: boolean;
  getSetting: (key: string) => string;
  saveSetting: (key: string, value: string) => void;
  saveSettings: () => void;
}

const useSettings = (): UseSettingsReturn  => {
  const [settings, setSettings] = useState<Settings>({});
  const { mutate: dbSaveSettings, isError: isErrorSaving } = usePluginSettingsMutation();
  const { data: dbSettings, isError: isErrorFetching } = usePluginSettingsQuery();
  const saveSettings = () => {
    dbSaveSettings(settings)
  };
  const getSetting = (key: string) => settings[key] || '';
  const saveSetting = (key: string, value: any) => {
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
  }
}

export default useSettings;
