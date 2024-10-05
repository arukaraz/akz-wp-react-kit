import React from 'react';
import { PreferencesContextProvider } from './PreferencesContext';

const combineProviders = (...providers) => ({ children }) =>
  providers.reduceRight(
    (acc, Provider) => <Provider>{acc}</Provider>,
    children
  );

const CombinedProvider = combineProviders(
  PreferencesContextProvider,
  // add your providers here
);

export default function ContextProvider({ children }) {
  return <CombinedProvider>{children}</CombinedProvider>;
}