// import React from 'react';
// import ReactDOM from 'react-dom';
// import { Provider } from 'react-redux';
// import store from "@/react/store/store.js";
// import App from './App';
//
//
// ReactDOM.render(
//     <Provider store={store}>
//         <App />
//     </Provider>,
//     document.getElementById('react-root')
// );
import React from 'react';
import ReactDOM from 'react-dom/client';
import { Provider } from 'react-redux';
import store from "./store/store.js";
import App from './App';

const root = ReactDOM.createRoot(document.getElementById('react-root'));
root.render(
    <Provider store={store}>
        <App />
    </Provider>
);
