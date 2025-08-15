require('./bootstrap');

import NProgress from 'nprogress';
import 'nprogress/nprogress.css';

console.log(NProgress);

window.NProgress = NProgress;


NProgress.configure({ showSpinner: false, trickleSpeed: 100 });

document.addEventListener("livewire:navigating", () => {
    console.log('Navigating');
    NProgress.start();
});

document.addEventListener("livewire:navigated", () => {
    console.log('Navigation done');
    NProgress.done();
});