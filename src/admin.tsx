import * as React from "react";
import * as ReactDOM from "react-dom/client";
import {
  createHashRouter,
  RouterProvider,
} from "react-router-dom";
import App from "./admin/App";
import routes from "./admin/routes";

const router = createHashRouter([
  {
    path: `/`,
    element: <App />,
    children: routes,
  },
]);

document.addEventListener('DOMContentLoaded', () => {
  const rootElement = document.getElementById(AkzWpReactKitLocalize.root_id);

  if (rootElement) {
      ReactDOM.createRoot(rootElement).render(
        <React.StrictMode>
          <RouterProvider router={router} />
        </React.StrictMode>
      );
  }
});
