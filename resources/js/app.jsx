import './bootstrap';
import '../css/app.css'; 
import React from 'react';
import ReactDOM from 'react-dom';
import ExampleComponent from './components/ExampleComponent';

if (document.getElementById('example')) {
    const container = document.getElementById('example');
    const root = ReactDOM.createRoot(container); // Create a root
    root.render(<ExampleComponent />); // Render your component with createRoot
}