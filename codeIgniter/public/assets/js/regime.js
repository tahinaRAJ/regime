(function(){
  const choicesEl = document.getElementById('choices');
  const regimesArea = document.getElementById('regimesArea');
  const forecastWeight = document.getElementById('forecastWeight');
  const forecastDuration = document.getElementById('forecastDuration');
  const forecastCost = document.getElementById('forecastCost');

  function escapeHtml(s){return (s||'').toString().replace(/[&<>"']/g,ch=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[ch]);}

  function renderChoices(objectifs){
    choicesEl.innerHTML = '';
    if(!objectifs || objectifs.length === 0){
      choicesEl.innerHTML = '<div class="placeholder">Aucun objectif disponible</div>';
      return;
    }

    objectifs.forEach(obj => {
      const btn = document.createElement('button');
      btn.className = 'choice-btn';
      btn.textContent = obj.nom || obj['nom'];
      btn.dataset.id = obj.id || obj['id'];
      btn.addEventListener('click', function(){
        document.querySelectorAll('#choices .choice-btn').forEach(b=>b.classList.remove('active'));
        btn.classList.add('active');
        onChoiceClick(btn.dataset.id);
      });
      choicesEl.appendChild(btn);
    });
  }

  function renderRegimes(regimes, objectiveId){
    regimesArea.innerHTML = '';
    if(!regimes || regimes.length === 0){
      regimesArea.innerHTML = '<div class="placeholder">Aucun régime trouvé pour cet objectif.</div>';
      clearForecast();
      return;
    }

    regimes.forEach(r=>{
      const card = document.createElement('div');
      card.className = 'regime-card';
      const nom = escapeHtml(r.nom ?? r['nom'] ?? 'Régime');
      const desc = escapeHtml(r.description ?? r['description'] ?? '');
      const variation = (r.variationParCycleKg ?? r.variation ?? r.poidsInfluencefood ?? 0);
      const targetKg = (r.objectifKg ?? 0);
      const isGain = variation > 0;
      const jours = r.joursEstimes ?? r.jours ?? r.joursEstimes ?? '-';
      const cout = r.coutEstime ?? r.cout ?? r.coutEstime ?? '-';
      const detailHref = `/paiement/regime/${r.id}${objectiveId ? `?objectif=${encodeURIComponent(objectiveId)}` : ''}`;

      card.innerHTML = `<h4>${nom}</h4>
        <p>${desc}</p>
        <div class="regime-meta">Variation par cycle: <strong>${variation > 0 ? '+' : ''}${variation} kg</strong> · Durée: <strong>${jours} jours</strong></div>
        <a class="see-more" href="${detailHref}">Voir plus</a>`;

      card.addEventListener('click', ()=>{
        forecastWeight.textContent = (isGain ? '+' : '-') + targetKg;
        forecastDuration.textContent = jours;
        forecastCost.textContent = (cout !== '-') ? (cout + ' €') : '-';
      });
      regimesArea.appendChild(card);
    });

    const first = regimes[0];
    if(first){
      const variation = (first.variationParCycleKg ?? first.variation ?? first.poidsInfluencefood ?? 0);
      const targetKg = (first.objectifKg ?? 0);
      const isGain = variation > 0;
      const jours = first.joursEstimes ?? first.jours ?? '-';
      const cout = first.coutEstime ?? first.cout ?? '-';
      forecastWeight.textContent = (isGain ? '+' : '-') + targetKg;
      forecastDuration.textContent = jours;
      forecastCost.textContent = (cout !== '-') ? (cout + ' €') : '-';
    }
  }

  function clearForecast(){
    forecastWeight.textContent = '-';
    forecastDuration.textContent = '-';
    forecastCost.textContent = '-';
  }

  async function loadObjectifs(){
    try{
      const res = await fetch('/regime/objectifs');
      if(!res.ok) throw new Error('Erreur réseau');
      const data = await res.json();
      renderChoices(data);
    }catch(err){
      console.error('Impossible de charger les objectifs', err);
      choicesEl.innerHTML = '<div class="placeholder">Impossible de charger les objectifs</div>';
    }
  }

  async function onChoiceClick(id){
    if(!id) return;
    const numericId = parseInt(id,10);

    if (numericId >= 3) {
      window.location.href = '/regime/imc';
      return;
    }

    regimesArea.innerHTML = '<div class="placeholder">Chargement...</div>';
    try{
      const headers = {
        'X-Requested-With': 'XMLHttpRequest'
      };
      const res = await fetch('/regime/list?Idoption=' + encodeURIComponent(numericId), {
        method: 'GET',
        headers: headers
      });

      const ctype = res.headers.get('content-type') || '';
      if(ctype.includes('application/json')){
        const data = await res.json();
        renderRegimes(data, numericId);
        return;
      }

      if(ctype.includes('text/html')){
        const html = await res.text();
        regimesArea.innerHTML = html;
        clearForecast();
        return;
      }

      const text = await res.text();
      try{
        const parsed = JSON.parse(text);
        renderRegimes(parsed);
        return;
      }catch(e){
        regimesArea.innerHTML = text;
        clearForecast();
      }

    }catch(err){
      console.error('Erreur lors de la récupération des régimes', err);
      regimesArea.innerHTML = '<div class="placeholder">Erreur lors du chargement des régimes</div>';
      clearForecast();
    }
  }

  loadObjectifs();
})();
