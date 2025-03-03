const characterInformation = document.getElementById("character-information");
const characterInformationName = document.getElementById("character-information-name");
const characterInformationVoice = document.getElementById("character-information-voice");
const characterInformationSplashArt = document.getElementById("character-information-splash-art");

//Dernière voiceline jouée
const lastVoicePlayed = {
    "characterID" : null,
    "numberVoiceline" : null
}
//Personnages affichés actuellement
charactersDisplayed = [];
//Affiche la première origine
changeOrigin('1');
//Premier personnage de la liste actuellement
let currentFirstCharacter = charactersDisplayed[0];
//Ancien premier personnage de la liste
let oldFirstCharacter = null;

/**
 * Change l'origine actuellement affichée.
 * @param {int} id Identifiant unique de l'origine
 * @return {void}
 */
function changeOrigin(id){
    for (enfant of document.getElementById("list-characters").children){
        enfant.classList.add("character-hidden");
    };
    document.getElementById("character-information").classList.remove("character-information-displayed");
    if ((document.getElementById("list-characters").classList.contains("list-characters-reduced"))){
        document.getElementById("list-characters").classList.remove("list-characters-reduced");
    }
    if (document.getElementById("button-next-character").style.display == "block"){
        document.getElementById("button-next-character").style.display = "";
    }
    charactersDisplayed = [];
    for (character in characters){
        document.getElementById("character-" + character).style.order = 0;
        if (id == characters[character]["origin"]){
            document.getElementById("character-" + character).classList.remove("character-hidden");
            charactersDisplayed.push(character);
        }
    }
}

/**
 * Affiche les informations du personnage.
 * @param {int} id Identifiant unique du personnage
 * @return {void}
 */
function openCharacterInformation(id){
    if (!(document.getElementById("list-characters").classList.contains("list-characters-reduced"))){
        document.getElementById("list-characters").classList.add("list-characters-reduced");
    }
    if (document.getElementById("button-next-character").style.display == ""){
        document.getElementById("button-next-character").style.display = "block";
    }
    const character = characters[id];
    characterInformationSplashArt.src = "../assets/images/characters_splash_arts/" + id + ".jpg";
    characterInformationName.textContent = character["name"];
    characterInformationVoice.textContent = character["voice"];
    if (!(characterInformation.classList.contains("character-information-displayed"))){
        characterInformation.classList.add("character-information-displayed")
    }
    if (oldFirstCharacter != null){
        getCharacterFromID(oldFirstCharacter).classList.remove("character-selected");
    }
    getCharacterFromID(id).classList.add("character-selected");
}

/**
 * Modifie l'ordre des personnages affichés.
 * @param {int} id Identifiant unique du personnage en première position
 * @return {void}
 */
function updateOrderCharacters(id){
    oldFirstCharacter = currentFirstCharacter;
    currentFirstCharacter = id;
    getCharacterFromID(id).style.order = 0;

    let i = charactersDisplayed.indexOf(id);
    let j = (i + 1) % charactersDisplayed.length;
    let nextOrder = 1;
    while (j != i){
        getCharacterFromID(charactersDisplayed[j]).style.order = nextOrder;
        j = (j + 1) % charactersDisplayed.length;
        nextOrder += 1
    }
}

/**
 * Fonction appelée lors d'un clic sur un personnage.
 * @param {int} id Identifiant unique du personnage
 * @return {void}
 */
function openCharacter(id){
    updateOrderCharacters(id);
    openCharacterInformation(id);
}

/**
 * Navigue jusqu'au prochain personnage.
 * @return {void}
 */
function nextCharacter(){
    updateOrderCharacters(getIDNextCharacter(currentFirstCharacter));
    openCharacterInformation(currentFirstCharacter);
}

/**
 * Récupère l'identifiant unique du prochain personnage.
 * @param {int} id Identifiant unique du personnage le précédent
 * @return {int}
 */
function getIDNextCharacter(id){
    return charactersDisplayed[((charactersDisplayed.indexOf(id) + 1) % charactersDisplayed.length)];
}

/**
 * Récupère le conteneur HTML du personnage.
 * @param {int} id Identifiant unique du personnage
 * @return {HTMLElement}
 */
function getCharacterFromID(id){
    return document.getElementById("character-" + id);
}

/**
 * Joue la prochaine voiceline du personnage affiché.
 * @return {void}
 */
function playCurrentCharacterVoice(){
    const characterID = currentFirstCharacter;
    const numberVoiceline = getNextNumberVoicelineCaracter(characterID);
    document.getElementById("character-voice-audio").src = "../assets/sounds/characters/" + characterID + "_" + numberVoiceline  + ".mp3";
    document.getElementById("character-voice-audio").play();

    lastVoicePlayed["characterID"] = characterID;
    lastVoicePlayed["numberVoiceline"] = numberVoiceline;
}

/**
 * Récupère le numéro de la prochaine voiceline du personnage.
 * @return {int}
 */
function getNextNumberVoicelineCaracter(id){
    if (lastVoicePlayed["characterID"] == null ){
        return 0;
    }
    if (lastVoicePlayed["numberVoiceline"] == null){
        return 0;
    }
    if (lastVoicePlayed["characterID"] != id){
        return 0;
    }
    return (lastVoicePlayed["numberVoiceline"] + 1) % 2;
}