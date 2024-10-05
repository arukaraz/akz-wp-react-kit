/* React */
import * as React from 'react';
/* WordPress */
import { __ } from '@wordpress/i18n';
/* MUI */
import List from '@mui/material/List';
import ListItemIcon from '@mui/material/ListItemIcon';
import ListItemText from '@mui/material/ListItemText';
import ExtensionIcon from '@mui/icons-material/Extension';
import ListSubheader from '@mui/material/ListSubheader';
import ListItemButton from '@mui/material/ListItemButton';
import DescriptionIcon from '@mui/icons-material/Description';


import { useLocation, useNavigate } from 'react-router-dom';

import routes from '../../../routes';

const Sidebar = () => {
    const { pathname: currentPath, search } = useLocation()
    const navigate = useNavigate();
    const currentSearchParams = search;

    const handleNavigate = (newValue) => {
        navigate(`${newValue}${currentSearchParams}`);
    }

    const preferencesRoutes = routes.find(route => route.path === '/preferences');
    
    return (
        <List
            sx={{ width: '100%', maxWidth: 360, bgcolor: 'background.paper' }}
            component="nav"
            aria-labelledby="nested-list-subheader"
        >
            {preferencesRoutes ? preferencesRoutes?.children?.map(route => (
                <ListItemButton
                    onClick={() => handleNavigate(route.path)}
                    selected={currentPath === route.path}
                >
                    <ListItemIcon>
                        {route.icon ? <route.icon /> : null}
                    </ListItemIcon>
                    <ListItemText primary={route.name} />
                </ListItemButton>
            )) : null}
            <ListSubheader>{__('Plugin info & configuration')}</ListSubheader>
            <ListItemButton>
                <ListItemIcon>
                    <ExtensionIcon />
                </ListItemIcon>
                <ListItemText primary={__('Settings')} />
            </ListItemButton>
            <ListItemButton>
                <ListItemIcon>
                    <DescriptionIcon />
                </ListItemIcon>
                <ListItemText primary={__('Changelog')} />
            </ListItemButton>
        </List>
    );
};

export default Sidebar;
