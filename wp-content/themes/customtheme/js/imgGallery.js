function createImageGallery(modalId, imagesArray) {
    let currentIndex = 0;
    const modal = document.getElementById(modalId);
    const modalImage = modal.querySelector('#modalImage');

    function openModal(index) {
        currentIndex = index;
        modalImage.src = imagesArray[currentIndex];
        modal.classList.remove('hidden');
        document.addEventListener('keydown', handleKeydown);
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.removeEventListener('keydown', handleKeydown);
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % imagesArray.length;
        modalImage.src = imagesArray[currentIndex];
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + imagesArray.length) % imagesArray.length;
        modalImage.src = imagesArray[currentIndex];
    }

    function handleKeydown(event) {
        if (event.key === 'ArrowRight') {
            nextImage();
        } else if (event.key === 'ArrowLeft') {
            prevImage();
        } else if (event.key === 'Escape') {
            closeModal();
        }
    }

    function handleBackgroundClick(event) {
        if (event.target === modal) {
            closeModal();
        }
    }

    modal.querySelector('.next-button').addEventListener('click', nextImage);
    modal.querySelector('.prev-button').addEventListener('click', prevImage);
    modal.querySelector('.close-button').addEventListener('click', closeModal);

    modal.addEventListener('click', handleBackgroundClick);

    return {
        openModal,
        closeModal,
        nextImage,
        prevImage,
    };
}