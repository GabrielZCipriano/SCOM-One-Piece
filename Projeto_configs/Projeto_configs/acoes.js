function executarAcao(blocoNumero) {
    alert("Ação executada no Bloco " + blocoNumero);
    // Aqui você pode executar a ação desejada para cada bloco
}


function updateVolume() {
    const volumeControl = document.getElementById("volume-control");
    const volumeValue = document.getElementById("volume-value");
    const volume = volumeControl.value;
    
    // Atualize o valor do volume exibido
    volumeValue.textContent = `Volume: ${volume}`;
    
    // Aqui você pode fazer algo com o valor do volume, como ajustar o volume de um elemento de áudio
    // Exemplo: audioElement.volume = volume / 100;
}