document.addEventListener("DOMContentLoaded", function () {
  const translateButtons = document.querySelectorAll(".translate-btn");

  translateButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const remarque = this.dataset.remarque; // Get the remark text
      const container = this.closest(".remarque-container");

      // Show loading state
      this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traduction...';
      this.disabled = true;

      fetch("/api/python/translate", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
        body: JSON.stringify({ text: remarque }), // Send "text" instead of "texts"
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.translation) {
            // Expecting "translation" in the response
            container.innerHTML = `
              <span class="translated-remarque text-success">
                ${data.translation}
              </span>
              <button class="btn btn-sm btn-light" 
                      onclick="showOriginal(this)"
                      data-original="${remarque}">
                Voir original
              </button>
            `;
          }
        })
        .catch((error) => {
          console.error("Translation error:", error);
          this.innerHTML = "Erreur";
          this.classList.add("btn-danger");
        });
    });
  });
});

function showOriginal(button) {
  const container = button.closest(".remarque-container");
  const original = button.dataset.original;

  container.innerHTML = `
    <span class="original-remarque">${original}</span>
    <button class="btn btn-sm btn-secondary translate-btn" 
            data-remarque="${original}">
      Traduire
    </button>
  `;
}
