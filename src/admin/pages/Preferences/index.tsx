/* React */
import * as React from 'react';
/* WordPress */
import { __ } from '@wordpress/i18n';
/* MUI */
import Stack from "@mui/material/Stack";
/* Library */
import { Outlet } from "react-router-dom";
import toast from 'react-stacked-toast';

/*Inbuilt*/
import Card from "@mui/material/Card";
import Box from '@mui/material/Box/Box';
import Button from "@mui/material/Button";
import SaveIcon from "@mui/icons-material/Save";
import CardHeader from "@mui/material/CardHeader";
import CardContent from '@mui/material/CardContent/CardContent';
import CircularProgress from '@mui/material/CircularProgress/CircularProgress';

import Sidebar from "./components/Sidebar";
import { usePreferencesContext } from '../../../modules/context/PreferencesContext';
import usePluginSettingsQuery from '../../../hooks/api/queries/usePluginSettingsQuery';
import usePluginSettingsMutation from '../../../hooks/api/mutations/usePluginSettingsMutation';


const Settings = () => {
    const { savePreferences, preferences, canSave } = usePreferencesContext();
    const { isFetching } = usePluginSettingsQuery();
    const { isPending } = usePluginSettingsMutation();

    const handleSave = () => {
        // add needed validations
        savePreferences();
    }

    return (
        <Stack flexDirection="row">
            <Sidebar/>
            <Card sx={{width: '100%', height: '100vh', paddingLeft: '50px'}}>
                <CardHeader action={
                    <Box sx={{ m: 1, position: 'relative' }}>
                    <Button
                        onClick={handleSave}
                        disabled={!canSave}
                        variant="contained"
                        startIcon={<SaveIcon />}
                    >
                        Save
                    </Button>
                    {isPending && (
                        <CircularProgress
                            size={24}
                            sx={{
                                position: 'absolute',
                                top: '50%',
                                left: '50%',
                                marginTop: '-12px',
                                marginLeft: '-12px',
                            }}
                        />
                    )}
                </Box>
                } />
                <CardContent>
                    { !isFetching && <Outlet />}
                </CardContent>
            </Card>
        </Stack>
    );
};

export default Settings;
