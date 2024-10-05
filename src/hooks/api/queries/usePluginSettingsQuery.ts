import apiFetch from '@wordpress/api-fetch'
import { QueryKey, UseQueryResult, useQuery } from '@tanstack/react-query';

import { API_BASEURL } from '../../../utils/constants/general';

export default function usePluginSettings(): UseQueryResult<any, unknown> {
  
  return useQuery<any, unknown>({
    queryKey: [AkzWpReactKitLocalize.plugin_page_name, "settings"] as QueryKey,
    queryFn: () => apiFetch({
      path: `${API_BASEURL}/settings`,
    }),
  });
};
