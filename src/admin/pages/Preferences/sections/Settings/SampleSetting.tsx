import React from "react";

import { __ } from "@wordpress/i18n";

import Stack from "@mui/material/Stack";
import Switch from "@mui/material/Switch";
import TextField from "@mui/material/TextField";
import SettingIcon from "@mui/icons-material/Settings";
import FormControlLabel from "@mui/material/FormControlLabel";

import Setting from "../../components/Setting";
import { inputStyle } from "../../../../../utils/constants/styles";
import { usePreferencesContext } from "../../../../../modules/context/PreferencesContext";

const SampleSetting = ({size = '100%'}: {size?: string}) => {
  const { updatePreference, preferences } = usePreferencesContext();
  const value = preferences['sample-setting'] ?? '';

  const handleSettingChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    updatePreference('sample-setting', e.target.value);
  };

  const Action = () => (
    <FormControlLabel
      control={
        <Switch
          inputProps={{ 'aria-label': 'controlled' }}
        />
      }
      label=""
    />
  );

  return (
    <Setting
      title={__('Sample setting')}
      action={<Action />}
      icon={<SettingIcon color="action" />}
      sx={{ flexBasis: size, minWidth: size }}
    >
      <Stack flexDirection="row">
        <TextField
          required
          label={__('Sample setting')}
          autoComplete="off"
          variant="filled"
          sx={inputStyle}
          size="medium"
          onChange={handleSettingChange}
          value={value}
        />
      </Stack>
    </Setting>
  );
};

export default SampleSetting;
