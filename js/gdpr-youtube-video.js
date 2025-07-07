document.addEventListener("DOMContentLoaded", function() {
    console.log("GDPR YouTube Script geladen");

    // Alle Video-Container mit GDPR-Schutz finden
    document.querySelectorAll(".gdpr-youtube-video-container").forEach(container => {
        let activateButton = container.querySelector(".get_click_video");
        let videoId = activateButton.getAttribute("data-videoid");
        let playerContainer = container.querySelector("#playerContainer-" + videoId);
        let videoOverlay = container.querySelector(".video__item");

        if (activateButton) {
            activateButton.addEventListener("click", function(event) {
                event.preventDefault();

                console.log("YouTube-Video wird geladen: " + videoId);

                if (playerContainer) {
                    // YouTube IFrame erstellen
                    let iframe = document.createElement("iframe");
                    iframe.setAttribute("width", "560");
                    iframe.setAttribute("height", "315");
                    iframe.setAttribute("src", "https://www.youtube.com/embed/" + videoId + "?autoplay=1&rel=0");
                    iframe.setAttribute("title", "YouTube video player");
                    iframe.setAttribute("frameborder", "0");
                    iframe.setAttribute("allow", "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture");
                    iframe.setAttribute("allowfullscreen", "");

                    // Video-Container mit IFrame ersetzen
                    playerContainer.innerHTML = "";
                    playerContainer.appendChild(iframe);

                    // Overlay (Thumbnail) ausblenden
                    if (videoOverlay) {
                        videoOverlay.style.backgroundImage = "none";
                        videoOverlay.classList.add("video-active");
                    }
                }
            });
        }
    });
});
