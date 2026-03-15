import { Card, CardHeader, CardContent, CardProps } from "@mui/material";
import { ReactNode } from "react";

interface SettingProps extends CardProps {
    title?: string;
    description?: string;
    icon?: ReactNode;
    action?: ReactNode;
    children: ReactNode;
}

const Setting = ({ title, description, icon, action, children, ...rest }: SettingProps) => {
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
