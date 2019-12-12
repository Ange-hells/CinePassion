<?php
/*================================================================================================================
 fichier			: class.collection.inc.php
 auteur				: 
 date de création	: mai 2013
 rôle				: décrit la classe collection qui permet de gérer une collection d'éléments
 ================================================================================================================*/

class navigation {
    
    private $module;		
    private $page;		
    private $action;
    private $nbSections;
    private $Section;
    //private $sectionCourante;
    
    /**
     * Le constructeur de la classe collection permet d'initialiser tous les attributs de la classe
     * @param 'Booleen' $tailleFixe : true si la taille est fixe, false sinon (false est la valeur par défaut)
     * @param integer $tailleMax : le nombre maximum d'éléments qui sont gérés par la collection (valeur par défaut : 50)
     * @return null
     * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
     * @version 1.0
     * @copyright Christophe Goidin - mai 2013
     */
    public function __construct($module, $page, $action, $section, $nbSections) {
       
        $this->module = $module;
        $this->page = $page;
        $this->action = $action;
        $this->nbSections = $nbSections;
        $this->section = $section;
        
    }
    
//     public function __get() {
        
//     }
    
//     public function __set(){
        
//     }

//     public function getSectionCourante(){
//         //($this->section < $this->nbSections) ? ($this->section < 1) ? $this->section = 1 : $this->section : $this->section = $this->nbSections;
//         if ($this->section < $this->nbSections){
//             $sectionCourante = $this->section;
//         }elseif ($this->section < 1){
//             $sectionCourante=$this->section = 1;
//         }else {
//             $sectionCourante=$this->section = $this->nbSections;
//         }
//         return $sectionCourante;
//     }
    
    public function getBoutons(){
        if ($this->section == 1) {
            return "<img alt='' src= './image/divers/firstSectionInactif.png'/>
					<img alt='' src= './image/divers/prevSectionInactif.png'/>
                    <a href='./index.php?module=" . ($this->module) . "&amp;page=" . ($this->page) . "&action=" .  ($this->action) . "&amp;section=" . ($this->section + 1) . "'><img alt='' src= './image/divers/nextSectionActif.png' /></a>
					<a href='./index.php?module=" . ($this->module) . "&amp;page=" . ($this->page) . "&action=defaut&section=" . ($this->nbSections) . "'><img alt='' src= './image/divers/lastSectionActif.png'/></a>";
            
        }elseif ($this->section == $this->nbSections) {
            return "<a href='./index.php?module=" . ($this->module) . "&amp;page=" . ($this->page) . "&action=defaut&section=" . "1" . "'><img alt='' src= './image/divers/firstSectionActif.png'/></a>
					<a href='./index.php?module=" . ($this->module) . "&amp;page=" . ($this->page) . "&action=defaut&section=" . ($this->section - 1) . "'><img alt='' src= './image/divers/prevSectionActif.png'/></a>
					<img alt='' src= './image/divers/nextSectionInactif.png'/>
					<img alt='' src= './image/divers/lastSectionInactif.png'/>";
            
        }else{
            return "<a href='./index.php?module=" . ($this->module) . "&amp;page=" . ($this->page) . "&action=defaut&section=" . "1" . "'><img alt='' src= './image/divers/firstSectionActif.png'/></a>
					<a href='./index.php?module=" . ($this->module) . "&amp;page=" . ($this->page) . "&action=defaut&section=" . ($this->section - 1) . "'><img alt='' src= './image/divers/prevSectionActif.png'/></a>
					<a href='./index.php?module=" . ($this->module) . "&amp;page=" . ($this->page) . "&action=defaut&section=" . ($this->section + 1) . "'><img alt='' src= './image/divers/nextSectionActif.png' /></a>
					<a href='./index.php?module=" . ($this->module) . "&amp;page=" . ($this->page) . "&action=defaut&section=" . ($this->nbSections) . "'><img alt='' src= './image/divers/lastSectionActif.png'/></a>";
            
        }
        
    }
    
    /**
     * 
     * @param int $nbAffiches
     * @return string
     */
    public function getNumeros($nbAffiches) {
        $numeros = "";
        $nbAffiches = ceil($nbAffiches);
        $i = 1;
        while ($i < ($this->nbSections + 1)) {
            if ($i >= ($this->section - $nbAffiches) and $i <= ($this->section + $nbAffiches) or $i == 1 or $i == ($this->nbSections)){
                if ($i == ($this->section)){
                    $numeros .= "<span id='section'><u><b>$i</b></u></span>";
                }else{
                    $numeros .= "<a href='./index.php?module=".$this->module . "&amp;page=" . $this->page . "&amp;action="  . $this->action . "&amp;section=" . $i ."'> " . $i . " </a>";
                }
            }elseif($i == $this->section - $nbAffiches - 1  or $i == $this->section + ($nbAffiches + 1)){
                $numeros .= "<a> ...</a>";
            }
            $i += 1;
        }
        return $numeros;
    }
    
}