/* React */
import React from 'react';
/* MUI */
import Tab from '@mui/material/Tab';
import Box from '@mui/material/Box';
import Tabs from '@mui/material/Tabs';
import AppBar from '@mui/material/AppBar';
import Toolbar from '@mui/material/Toolbar';
import Container from '@mui/material/Container';
import Typography from '@mui/material/Typography';
import ExtensionIcon from '@mui/icons-material/Extension';

/* WordPress */
import {__} from "@wordpress/i18n";

/* Misc */
import { useLocation, useNavigate, } from "react-router-dom";


import routes from '../../routes';
import { PLUGIN_FRIENDLY_NAME } from '../../../utils/constants/general';
import { isParentOrExactPath } from '../../../utils/isParentOrExactPath';

const Navigation = () => {
    const {pathname: currentPath, search} = useLocation()
    const navigate = useNavigate();
    const currentSearchParams = search;

    const handleNavigate = (_, newValue) => {
        navigate(`${newValue}${currentSearchParams}`);
    }


  return (
    <AppBar position="static">
            <Container sx={{ padding: 0, margin: 0 }} maxWidth={false}>
                <Toolbar>
                    <ExtensionIcon sx={{ display: 'flex', mr: 2 }} />
                    <Typography
                        variant="h6"
                        noWrap
                        component="a"
                        sx={{
                            mr: 2,
                            fontFamily: 'monospace',
                            fontWeight: 700,
                            letterSpacing: '.3rem',
                            color: 'inherit',
                            textDecoration: 'none',
                        }}
                    >
                        {PLUGIN_FRIENDLY_NAME.toUpperCase()}
                    </Typography>
                    <ExtensionIcon sx={{ display: { xs: 'flex', md: 'none' }, mr: 1 }} />
                    <Box sx={{ flexGrow: 1, display: { xs: 'none', md: 'flex' } }}>
                        <Tabs onChange={handleNavigate}>
                            {
                                routes.map(route => (
                                    <Tab
                                     key={route.path}
                                     label={route.name}
                                     value={route.path === '/preferences' ? '/preferences/settings' : route.path}
                                     sx={{
                                        color: isParentOrExactPath(currentPath, route.path) ? 'primary.main' : 'white',
                                        backgroundColor: isParentOrExactPath(currentPath, route.path) ? 'white' : 'primary.main'
                                      }}
                                    />
                                ))
                            }
                        </Tabs>
                    </Box>
                </Toolbar>
            </Container>
        </AppBar>
  )
}

export default Navigation;