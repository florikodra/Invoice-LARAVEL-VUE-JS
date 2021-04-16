import Invoices from './components/Invoices.vue';
import CreateInvoice from './components/CreateInvoice.vue';
import PDFInvoice from './components/pdfInvoice.vue';

 
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