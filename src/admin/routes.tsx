import React from "react";
import { __ } from '@wordpress/i18n';

import Home from "./pages/Home";
import Preferences from "./pages/Preferences";
import Settings from "./pages/Preferences/sections/Settings";
import SettingsIcon from '@mui/icons-material/Settings';

export default [
  {
    path: "/",
    name: __('Home'),
    element: <Home />,
  },
  {
    path: "/preferences",
    name: __('Preferences'),
    element: <Preferences />,
    children: [
      {
        name: __('Settings'),
        path: "settings",
        icon: SettingsIcon,
        element: <Settings />,
      }
    ]
  },
];
