import React, { useEffect, useRef, useState } from 'react';
import { createRoot } from 'react-dom/client';
import { renderToString } from 'react-dom/server';
import Modal from 'react-modal';
import 'sode-extend-react/sources/string';
import Swal from 'sweetalert2';
import CreateReactScript from '../Utils/CreateReactScript';
import { set } from 'sode-extend-react/sources/cookies';
import axios from 'axios';


Modal.setAppElement('#app');


const Dashboard = ({ statuses, horarios }) => {


  return (
    <div className="min-h-screen bg-gray-50 dark:bg-slate-900 dark:border-slate-700  ">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 py-8">
        {/* Header */}
        <div className="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
          <div>
            <h1 className="text-2xl font-bold text-gray-900 dark:text-slate-100">Hola </h1>
          </div>
          <div className="mt-4 md:mt-0">
            <a className='btn rounded-md bg-slate-400 text-white' href="/api/auth/google/redirect" target='_blank'>Iniciar Sesion Google  </a>

          </div>

        </div>

      </div>
    </div>
  )
}

CreateReactScript((el, properties) => {
  createRoot(el).render(<Dashboard {...properties} />);
})