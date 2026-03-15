import apiFetch from '@wordpress/api-fetch';
import { UseQueryResult, useQuery } from '@tanstack/react-query';

import { PluginSettings } from '../../../types/settings';
import { API_BASEURL } from '../../../utils/constants/general';

export default function usePluginSettingsQuery(): UseQueryResult<PluginSettings> {
  return useQuery<PluginSettings>({
    queryKey: [AkzWpReactKitLocalize.plugin_page_name, "settings"],
    queryFn: () => apiFetch<PluginSettings>({
      path: `${API_BASEURL}/settings`,
    }),
  });
}
