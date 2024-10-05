import {__} from "@wordpress/i18n";
import toast from 'react-stacked-toast';
import apiFetch from '@wordpress/api-fetch'
import { useMutation } from '@tanstack/react-query';

import { API_BASEURL } from '../../../utils/constants/general';

export default function usePluginSettingsMutation() {

  return useMutation({
    mutationFn: (payload: object) => apiFetch({
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
  })
};
