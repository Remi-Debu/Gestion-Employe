<?php
class Employe
{
    private $noemp;
    private $nom;
    private $prenom;
    private $emploi;
    private $sup;
    private $embauche;
    private $sal;
    private $comm;
    private $ajout;
    private Service $service;
    private Employe $superieur;

    /**
     * Get the value of noemp
     */
    public function getNoemp()
    {
        return $this->noemp;
    }

    /**
     * Set the value of noemp
     *
     * @return  self
     */
    public function setNoemp($noemp)
    {
        $this->noemp = $noemp;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of emploi
     */
    public function getEmploi()
    {
        return $this->emploi;
    }

    /**
     * Set the value of emploi
     *
     * @return  self
     */
    public function setEmploi($emploi)
    {
        $this->emploi = $emploi;

        return $this;
    }

    /**
     * Get the value of sup
     */
    public function getSup()
    {
        return $this->sup;
    }

    /**
     * Set the value of sup
     *
     * @return  self
     */
    public function setSup($sup)
    {
        $this->sup = $sup;

        return $this;
    }

    /**
     * Get the value of embauche
     */
    public function getEmbauche()
    {
        return $this->embauche;
    }

    /**
     * Set the value of embauche
     *
     * @return  self
     */
    public function setEmbauche($embauche)
    {
        $this->embauche = $embauche;

        return $this;
    }

    /**
     * Get the value of sal
     */
    public function getSal()
    {
        return $this->sal;
    }

    /**
     * Set the value of sal
     *
     * @return  self
     */
    public function setSal($sal)
    {
        $this->sal = $sal;

        return $this;
    }

    /**
     * Get the value of comm
     */
    public function getComm()
    {
        return $this->comm;
    }

    /**
     * Set the value of comm
     *
     * @return  self
     */
    public function setComm($comm)
    {
        $this->comm = $comm;

        return $this;
    }

    /**
     * Get the value of ajout
     */
    public function getAjout()
    {
        return $this->ajout;
    }

    /**
     * Set the value of ajout
     *
     * @return  self
     */
    public function setAjout($ajout)
    {
        $this->ajout = $ajout;

        return $this;
    }

    /**
     * Get the value of service
     */ 
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set the value of service
     *
     * @return  self
     */ 
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get the value of superieur
     */ 
    public function getSuperieur()
    {
        return $this->superieur;
    }

    /**
     * Set the value of superieur
     *
     * @return  self
     */ 
    public function setSuperieur($superieur)
    {
        $this->superieur = $superieur;

        return $this;
    }
}
