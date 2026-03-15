import { createContext, useState, ReactNode, useContext, useEffect } from 'react';
import useSettings from '../../../hooks/useSettings';
import { PluginSettings, SettingValue } from '../../../types/settings';

const preferencesDefaultValues: PluginSettings = {
  'sample-setting': 'changeme',
};

interface PreferencesContextType {
  preferences: PluginSettings;
  canSave: boolean;
  updatePreference: (key: string, value: SettingValue) => void;
  savePreferences: () => void;
}

const PreferencesContext = createContext<PreferencesContextType | undefined>(undefined);

interface PreferencesProviderProps {
  children: ReactNode;
}

const PreferencesContextProvider = ({ children }: PreferencesProviderProps) => {
  const { getSetting, saveSetting, saveSettings, settings } = useSettings();
  const [preferences, setPreferences] = useState<PluginSettings>(preferencesDefaultValues);
  const [canSave, setCanSave] = useState<boolean>(false);

  const updatePreference = (key: string, value: SettingValue) => {
    const newPreferences = { ...preferences, [key]: value };
    setPreferences(newPreferences);
    saveSetting('preferences', JSON.stringify(newPreferences));
    setCanSave(true);
  };

  const savePreferences = () => {
    saveSettings();
    setCanSave(false);
  };

  useEffect(() => {
    const pref: string = getSetting('preferences');
    const parsed: PluginSettings = pref
      ? { ...preferencesDefaultValues, ...JSON.parse(pref) as PluginSettings }
      : preferencesDefaultValues;
    setPreferences(parsed);
  }, [settings]);

  return (
    <PreferencesContext.Provider value={{
      preferences,
      canSave,
      updatePreference,
      savePreferences
    }}>
      {children}
    </PreferencesContext.Provider>
  );
};

const usePreferencesContext = () => {
  const context = useContext(PreferencesContext);
  if (!context) {
    throw new Error("usePreferencesContext must be used within PreferencesProvider");
  }

  return context;
};

export { PreferencesContextProvider, usePreferencesContext };
