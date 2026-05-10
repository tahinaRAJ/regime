(function(){
  const form = document.getElementById('imcTopForm');
  const panel = document.getElementById('recommendationsPanel');
  const imcInput = document.getElementById('imc_ideal_top');
  const imcActuelBox = document.getElementById('imcActuelBox');
  const submitBtn = document.getElementById('seeRecBtn');

  if(!form || !panel || !imcInput || !submitBtn) return;

  function escapeHtml(s){
    return (s||'').toString().replace(/[&<>"']/g, ch => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":"&#39;"})[ch]);
  }

  function setStatus(message, isError){
    let st = document.getElementById('imcStatus');
    if(!st){
      st = document.createElement('div');
      st.id = 'imcStatus';
      st.setAttribute('role','status');
      st.setAttribute('aria-live','polite');
      st.className = 'imc-status';
      form.parentNode.insertBefore(st, form.nextSibling);
    }
    st.textContent = message || '';
    st.classList.toggle('error', !!isError);
  }

  function clearStatus(){ setStatus(''); }

  function renderRegimes(regimes){
    panel.innerHTML = '';
    if(!regimes || regimes.length === 0){
      panel.innerHTML = '<div class="placeholder">Aucune recommandation pour cet IMC.</div>';
      return;
    }
    const list = document.createElement('div');
    list.className = 'regime-list';
    regimes.forEach(r => {
      const el = document.createElement('div');
      el.className = 'regime-card';
      const detailHref = `/paiement/regime/${r.id}`;
      el.innerHTML = `<h4>${escapeHtml(r.nom)}</h4>
        <p>${escapeHtml(r.description||'')}</p>
        <div class="regime-meta">Durée: <strong>${escapeHtml(r.joursEstimes)}</strong> jours · Coût: <strong>${escapeHtml(r.coutEstime)}</strong> €</div>
        <div style="margin-top:8px"><a class="see-more" href="${detailHref}">Voir plus</a></div>`;
      list.appendChild(el);
    });
    panel.appendChild(list);
  }

  async function fetchRecommendations(imc){
    const url = '/regime/recommendations/ajax?imc_ideal=' + encodeURIComponent(imc);
    const res = await fetch(url, {headers:{'X-Requested-With':'XMLHttpRequest'}});
    if(!res.ok) throw new Error('Erreur réseau');
    const data = await res.json();
    return data;
  }

  function disableForm(){
    imcInput.disabled = true;
    submitBtn.disabled = true;
    submitBtn.classList.add('loading');
  }

  function enableForm(){
    imcInput.disabled = false;
    submitBtn.disabled = false;
    submitBtn.classList.remove('loading');
  }

  function hideForm(animated = true){
    if(animated){
      form.classList.add('collapsed');
      setTimeout(()=> form.style.display = 'none', 320);
    }else{
      form.style.display = 'none';
    }
  }

  function showForm(){
    form.style.display = '';
    // allow next paint
    requestAnimationFrame(()=> form.classList.remove('collapsed'));
    enableForm();
    imcInput.focus();
    clearStatus();
  }

  function createModifyButton(){
    let btn = document.getElementById('imcModifyBtn');
    if(btn) return btn;
    btn = document.createElement('button');
    btn.type = 'button';
    btn.id = 'imcModifyBtn';
    btn.className = 'imc-modify-btn';
    btn.textContent = 'Modifier l\u2019IMC';
    btn.addEventListener('click', ()=>{
      showForm();
      btn.remove();
    });
    form.parentNode.insertBefore(btn, panel);
    return btn;
  }

  form.addEventListener('submit', async (e)=>{
    e.preventDefault();
    clearStatus();
    const raw = imcInput.value.trim();
    const imc = parseFloat(raw.replace(',', '.'));
    if(Number.isNaN(imc) || imc <= 0 || imc < 10 || imc > 60){
      setStatus('Veuillez entrer un IMC valide entre 10 et 60.', true);
      imcInput.focus();
      return;
    }

    hideForm(true);
    disableForm();
    panel.innerHTML = '<div class="placeholder">Chargement des recommandations...</div>';
    try{
      const recs = await fetchRecommendations(imc);
      renderRegimes(recs);
      createModifyButton();
    }catch(err){
      console.error(err);
      setStatus('Erreur lors du chargement des recommandations. Réessayez.', true);
      showForm();
    }finally{
      enableForm();
    }
  });

})();
