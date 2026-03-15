import React, { ReactNode } from 'react';
import { PreferencesContextProvider } from './PreferencesContext';

type ProviderComponent = React.ComponentType<{ children: ReactNode }>;

const combineProviders = (...providers: ProviderComponent[]) =>
  ({ children }: { children: ReactNode }) =>
    providers.reduceRight(
      (acc, Provider) => <Provider>{acc}</Provider>,
      children
    );

const CombinedProvider = combineProviders(
  PreferencesContextProvider,
);

export default function ContextProvider({ children }: { children: ReactNode }) {
  return <CombinedProvider>{children}</CombinedProvider>;
}
