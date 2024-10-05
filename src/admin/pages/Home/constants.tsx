import React from "react";

import {__} from "@wordpress/i18n";

import Chip from '@mui/material/Chip';
import { GridColDef } from "@mui/x-data-grid/models/colDef/gridColDef";
import { GridColumnVisibilityModel } from "@mui/x-data-grid/hooks/features/columns/gridColumnsInterfaces";

export const columnsVisibility: GridColumnVisibilityModel  = {
  id: false,
}

export const discountsColumns: GridColDef[] = [
  { field: 'id' },
  {
    field: 'active',
    headerName: __('Status'),
    width: 200,
    renderCell: value => value.row.active ?  <Chip label={__('Enabled')} color="primary" /> :  <Chip label={__('Disabled')} color="error" />,
    align: 'center'
  },
  { field: 'name', headerName: __('Discount name'), width: 250 },
  {
    field: 'productsTotal',
    headerName: `# ${__('Products Total')}`,
    width: 300,
    renderCell: value => value.row.products.length
  },
  {
    field: 'categories',
    headerName: `# ${__('Categories')}`,
    width: 300,
    renderCell: value => value.row.categories.length
  },
];