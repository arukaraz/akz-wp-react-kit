
import { Card, CardHeader, CardContent } from "@mui/material";
import React, { ReactNode } from "react";

interface SettingProps {
    title?: string;
    description?: string;
    icon?: ReactNode;
    action?: ReactNode;
    children: ReactNode;
    [key: string]: any;
}


const Setting: React.FC<SettingProps> = ({ title, description, icon, action, children, ...rest }) => {

    return (
        <Card {...rest}>
            <CardHeader
                avatar={icon}
                title={title}
                subheader={description}
                action={action}
            />
            <CardContent>
                {children}
            </CardContent>
        </Card>
    );
};

export default Setting;