import Invoices from './components/Invoices.vue';
import CreateInvoice from './components/CreateInvoice.vue';
import PDFInvoice from './components/pdfInvoice.vue';
import ViewInvoice from './components/ViewInvoice.vue';

 
export const routes = [
    {
        name: 'invoices',
        path: '/',
        component: Invoices
    },
    {
        name: 'create',
        path: '/create',
        component: CreateInvoice
    },
    {
        name: 'PDFInvoice',
        path: '/PDFInvoice',
        component: PDFInvoice
    },
    {
        name: 'view',
        path: '/view/:id',
        component: ViewInvoice
    },
    /* {
        name: 'edit',
        path: '/edit/:id',
        component: EditInvoice
    },
    {
        name: 'view',
        path: '/view/:id',
        component: ViewInvoice
    } */

];