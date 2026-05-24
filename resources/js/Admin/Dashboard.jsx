import React, { useEffect, useRef, useState } from 'react';
import { createRoot } from 'react-dom/client';
import { renderToString } from 'react-dom/server';
import Modal from 'react-modal';
import 'sode-extend-react/sources/string';
import Swal from 'sweetalert2';
import CreateReactScript from '../Utils/CreateReactScript';
import { set } from 'sode-extend-react/sources/cookies';
import axios from 'axios';
import Table from '../components/Table';
import ConvertionsRest from '../actions/ConvertionsRest';


Modal.setAppElement('#app');
const convertionsRest = new ConvertionsRest()

const Dashboard = ({ statuses, horarios }) => {
  const gridRef = useRef()

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
        <Table gridRef={gridRef}
          editing={{ allowUpdating: false, mode: 'cell' }}

          // filterValue={customFilter}
          rest={convertionsRest} exportable title='Conversiones'
          toolBar={(container) => {
            container.unshift({
              widget: 'dxButton', location: 'after',
              options: {
                icon: 'refresh',
                hint: 'Refrescar tabla',
                onClick: () => $(gridRef.current).dxDataGrid('instance').refresh()
              }
            });


          }}
          columns={[
            {
              dataField: 'id',
              caption: 'ID',
              visible: false,
              allowEditing: false

            },
            {
              dataField: 'orden_id',
              caption: 'Conversion_id',
              visible: true,

              allowEditing: false
            },

            {
              dataField: 'gclid',
              caption: 'Gclid',
              width: '180px',
              allowEditing: false
            },
            {
              dataField: 'conversion_value',
              caption: 'conversion_value',
              width: '180px',
              allowEditing: false
            },
            {
              dataField: 'currency_code',
              caption: 'currency_code',
              width: '180px',
              allowEditing: false
            },
            {
              dataField: 'conversion_action',
              caption: 'conversion_action',
              width: '180px',
              allowEditing: false
            },
            {
              dataField: 'customer_id',
              caption: 'customer_id',
              width: '180px',
              allowEditing: false
            },
            {
              dataField: 'conversion_time',
              caption: 'Hora de conversion',
              dataType: 'date',
              width: '180px',
              allowEditing: false
            },
            {
              dataField: 'status',
              caption: 'Estado',
              width: '180px',
              allowEditing: false
            },
            {
              dataField: 'attempts',
              caption: 'Intentos',
              width: '180px',
              allowEditing: false
            },
            {
              dataField: 'error_message',
              caption: 'Mensaje Error',
              width: '250px',
              allowEditing: false
            },






          ]}

        />

      </div>
    </div>
  )
}

CreateReactScript((el, properties) => {
  createRoot(el).render(<Dashboard {...properties} />);
})