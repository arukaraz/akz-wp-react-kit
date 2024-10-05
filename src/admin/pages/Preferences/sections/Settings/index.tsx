import { __ } from "@wordpress/i18n";

import * as React from "react";

import Box from "@mui/material/Box";

import SampleSetting from "./SampleSetting";

const Settings = () => {
   
    return (
        <>
            <Box display="flex" justifyContent="space-between">
                <SampleSetting size="60%" />
            </Box>
        </>
    );
};

export default Settings;
