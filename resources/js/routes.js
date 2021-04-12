import Invoices from './components/Invoices.vue';
import CreateInvoice from './components/CreateInvoice.vue';

 
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