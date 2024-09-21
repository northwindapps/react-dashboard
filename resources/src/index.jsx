import React from "react";
// import ReactDOM from "react-dom/client";
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Routes, Navigate } from "react-router-dom";

import "bootstrap/dist/css/bootstrap.min.css";
import "./assets/css/animate.min.css";
import "./assets/scss/light-bootstrap-dashboard-react.scss?v=2.0.0";
import "./assets/css/demo.css";
import "@fortawesome/fontawesome-free/css/all.min.css";

import AdminLayout from './layouts/Admin.jsx';

// const root = ReactDOM.createRoot(document.getElementById("root"));

// if (document.getElementById('root')) {
//   root.render(
//     <BrowserRouter>
//       <Routes>
//         <Route path="/admin" element={<AdminLayout />} />
//         <Route path="/" element={<Navigate to="/admin/dashboard" />} />
//       </Routes>
//     </BrowserRouter>
//   );
// }

if (document.getElementById('root')) {
  const container = document.getElementById('root');
  const root = ReactDOM.createRoot(container); // Create a root
  root.render( <div>
      <h1>Hello, React in Laravel!?</h1>
  </div>); // Render your component with createRoot
}

// root.render(<BrowserRouter>
//   <Routes>
//     <Route path="/admin" element={<AdminLayout />} />
//     <Route path="/" element={<Navigate to="/admin/dashboard" />} />
//   </Routes>
// </BrowserRouter>); // Render your component with createRoot
// }