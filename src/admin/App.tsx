import React from "react";

import { __ } from '@wordpress/i18n';
import { Outlet } from "react-router-dom";
import toast, { Toaster } from 'react-stacked-toast'
import { QueryClient, QueryClientProvider, QueryCache } from '@tanstack/react-query';

import Layout from "./layouts/TopNavigation";

const queryClient = new QueryClient({
  queryCache: new QueryCache({
    onError: () => {
      toast({
        title: __('Something went wrong'),
        description: __('An error occurred while fetching data'),
        type: 'error'
      })
    }
  }),
});

const App = () => {

  return (
    <QueryClientProvider client={queryClient}>
      <Layout>
        <Toaster position="center" toastOptions={{ duration: 3000, style: { marginTop: '30px' } }} />
        <Outlet />
      </Layout>
    </QueryClientProvider>
  );
};

export default App;