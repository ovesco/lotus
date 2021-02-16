(() => {
  const lotus = function() {
    this.lotusPath = "{{ lotusPath }}";
  };

  lotus.prototype.query = function (path, params) {
    return fetch(`${this.lotusPath}${path}`, {
      body: JSON.stringify(params),
    });
  };

  const lotusInstance = new lotus();

  {% for plugin in plugins %}
    {{ plugin.render() }}
  {% endfor %}

  lotusInstance.query('/pageView').then((response) => {

  }).catch((err) => {

  });

  window.lotus = lotusInstance;
})();
