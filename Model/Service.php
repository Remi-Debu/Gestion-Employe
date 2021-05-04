<?php
class Service
{
    private $noserv;
    private $service;
    private $ville;
    private $ajout;

    /**
     * Get the value of noserv
     */
    public function getNoserv()
    {
        return $this->noserv;
    }

    /**
     * Set the value of noserv
     *
     * @return  self
     */
    public function setNoserv($noserv)
    {
        $this->noserv = $noserv;

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
     * Get the value of ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

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
}
