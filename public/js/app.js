document.querySelector('[data-toggle-sidebar]')?.addEventListener('click',()=>document.getElementById('sidebar').classList.toggle('open'));
document.addEventListener('click',e=>{const sidebar=document.getElementById('sidebar');if(sidebar?.classList.contains('open')&&!sidebar.contains(e.target)&&!e.target.closest('[data-toggle-sidebar]'))sidebar.classList.remove('open');});
const confirmDialog=document.getElementById('confirm-dialog');let pendingForm=null;
document.querySelectorAll('form[data-confirm]').forEach(form=>form.addEventListener('submit',e=>{if(form.dataset.confirmed)return;e.preventDefault();pendingForm=form;document.getElementById('confirm-message').textContent=form.dataset.confirm;confirmDialog.showModal();}));
document.getElementById('confirm-cancel')?.addEventListener('click',()=>confirmDialog.close());
document.getElementById('confirm-yes')?.addEventListener('click',()=>{confirmDialog.close();if(pendingForm){pendingForm.dataset.confirmed='true';pendingForm.requestSubmit();}});
document.querySelectorAll('form').forEach(form=>form.addEventListener('submit',e=>{if(e.defaultPrevented)return;const button=form.querySelector('button[type=submit],button:not([type])');if(button){setTimeout(()=>{button.disabled=true;},0);setTimeout(()=>{button.disabled=false;},10000);}}));
