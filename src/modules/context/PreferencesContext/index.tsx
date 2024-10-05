import React, { createContext, useState, ReactNode, useContext, useEffect } from 'react';
import { Map as ImmutableMap } from 'immutable';
import useSettings from '../../../hooks/useSettings';

const preferencesDefaultValues = {
  'sample-setting': 'changeme',
};

interface PreferencesContextType {
  preferences: ImmutableMap<string, any>;
  canSave: boolean;

  updatePreference: (path: string[], value: any) => void;
  savePreferences: () => void;
}


const PreferencesContext = createContext<PreferencesContextType | undefined>(undefined);

interface PreferencesProviderProps {
  children: ReactNode;
}

const PreferencesContextProvider: React.FC<PreferencesProviderProps> = ({ children }) => {
  const { getSetting, saveSetting, saveSettings, settings } = useSettings();
  const [preferences, setPreferences] = useState<ImmutableMap<string, any>>(ImmutableMap(preferencesDefaultValues));
  const [canSave, setCanSave] = useState<boolean>(false);

  const updatePreference = (path: string[], value: any) => {
    const newPreferences = preferences.setIn(path, value);
    saveSetting('preferences', JSON.stringify(newPreferences));
    setCanSave(true);
  }

  const savePreferences = () => { 
    saveSettings();
    setCanSave(false);
  };

  useEffect(() => {
    const pref: string = getSetting('preferences');
    const preferences = pref ? ImmutableMap(JSON.parse(pref)) : ImmutableMap(preferencesDefaultValues);
    setPreferences(preferences as ImmutableMap<string, any>);
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
