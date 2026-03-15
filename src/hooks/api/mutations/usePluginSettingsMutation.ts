import { __ } from "@wordpress/i18n";
import toast from 'react-stacked-toast';
import apiFetch from '@wordpress/api-fetch';
import { useMutation, UseMutationResult } from '@tanstack/react-query';

import { PluginSettings } from '../../../types/settings';
import { API_BASEURL } from '../../../utils/constants/general';

export default function usePluginSettingsMutation(): UseMutationResult<PluginSettings, Error, PluginSettings> {
  return useMutation({
    mutationFn: (payload: PluginSettings) => apiFetch<PluginSettings>({
      path: `${API_BASEURL}/settings`,
      method: 'POST',
      data: payload,
    }),
    onSuccess: () => {
      toast({
        title: __('Success'),
        description: __('Changes saved successfully'),
        type: "success"
      });
    },
    onError: () => {
      toast({
        title: __('Error'),
        description: __('An error occurred while saving'),
        type: "error"
      });
    }
  });
}
