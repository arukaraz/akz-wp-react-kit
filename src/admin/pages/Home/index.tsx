import React from "react";

import {__} from "@wordpress/i18n";

import Box from '@mui/material/Box';
import Typography from '@mui/material/Typography'



const Home = () => {
	

	return  (
		<Box width="100%" maxWidth="100%" justifyContent="center" display="flex" height="80%">
			<Box width="100%" minWidth="1103px" maxWidth="1103px" display="flex" flexDirection="column">
				<Typography alignSelf="center" marginTop={20} variant="h3" color="initial">Your cool plugin's content goes here :)</Typography>
			</Box>
		</Box>
	)
}

export default Home;
