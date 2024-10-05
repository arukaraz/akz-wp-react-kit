import React from "react";

import Card from "@mui/material/Card";
import Container from "@mui/material/Container";

import Navigation from "./Navigation";
import ContextProvider from "../../../modules/context";

const TopNavigation = ({ children }) => {


  return (
    <Card sx={{ height: '100vh' }}>
      <ContextProvider>
        <Navigation />
        <Container sx={{ paddingY: '30px', height: '100vh', width: '100%', maxWidth: '100% !important' }}>
          {children}
        </Container>
      </ContextProvider>
    </Card>
  );
};

export default TopNavigation;
