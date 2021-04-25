import Invoices from './components/Invoices.vue';
import CreateInvoice from './components/CreateInvoice.vue';
import ViewInvoice from './components/ViewInvoice.vue';
import EditInvoice from './components/EditInvoice.vue';

 
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
        name: 'view',
        path: '/view/:id',
        component: ViewInvoice
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditInvoice
    },

];