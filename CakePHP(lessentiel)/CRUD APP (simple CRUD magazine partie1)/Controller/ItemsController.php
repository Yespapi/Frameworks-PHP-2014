<?php
/**
 * Description of ItemsController
 *
 * @author eyebe
 */
class ItemsController  extends AppController{
    
    // include the session componenet
    //declaer un composant
    public $components = array('Session');
    
     /**************** search **************************/
    /**
     * recherche les titres conrespondant au données entrer
     * 1.prend en argement un mot clés de recherches
     * 2.recherche le mot clés dans les titres des tables item
     * 3.sinon par defaut liste tous les titres
     * 3.utilise la fonction pour afficher le resutaltant sur la vue index
     * **/
      public function search($search = null)
    {
        if(!$search)
        {
            $data = $this->Item->find('all', array('order' => 'year'));
        }
        else
        {
			//-- Query the database using a Where clause
            $data = $this->Item->find('all', 
				array(
					'order' => 'year',
					'conditions' => array('title LIKE' => '%'.$search.'%')
                )
			);
        }
                
		// Set up your Variables to pass into the view
        $info = array(
            'items' => $data,
            'count' => count($data)
        );
        
        $this->set($info);

		// Use the index template instead of the default rendered search template
        $this->render('index');
    }
 
    
    /**************** delete **************************/
    /**
     * supprime un item via son id
     * 1.retrouve l'item son id 
     * 2.test si elle existe belle et bien 
     * 3. test si on a bien une requete post
     * 4.supprime l'item courant
     * 5.redirige vers l'index
     */
    public function delete($id = null)
    {
		// set the model to the id that you want to work with.
        $this->Item->id = $id;
        
		// does the item exist? is it set?
        if(!$id || !$this->Item->exists())
        {
            throw new NotFoundException(__("ID was not set."));
        }
        
		// make sure the request came via post
        if($this->request->is('post'))
        {
			// if the delete was a success
            if($this->Item->delete())
            {
				// display a message for the user to see the results
                $this->Session->setFlash(__("The item was deleted."));
            }
            else
            {
                $this->Session->setFlash(__("The ites was not deleted."));
            }
        }
      
		// redirect the user to the correct results page after the deletion
        $this->redirect('index');
    }
       
    
     /****************add **************************/
    /**
     * ajoute des catalogues de fils via un form
     * 1.test si la requete est de type post
     * 2.lcree l'objet Item
     * 3.sauvegarde l'objet dans sa table respective
     * 4.redirige l'utilisateur
     */
    public function add() 
    {
        // prepare the model to insert a new item in the database
        if($this->request->is('post')) 
        {
              $this->Item->create();
              
              if($this->Item->save($this->request->data))
              {
                  $this->redirect('index');
              }
              else 
              {
                   //ne faeit rien
                  
              }
        }
        
        
    }
   
    /****************view **************************/
    //view page de recherche
    /**
     * 1.prend en parametre un id
     * 2.recheche l'item qui al'id conrespondant
     * 3.socke l'informatin dans une variable data
     * 4.qui lui même est stcoké dans item
     */
    public function view($id =null) 
    {
        if(!$id) 
        {
            throw new NotFoundException(__("ID was note set .."));
            
        }
            // search the database based on the id (primary key) of the item 
        $data=$this->Item->findById($id);
        
        if(!$data) 
        {
           throw new NotFoundException(__("ID was not int the database"));
            
        }
        $this->set('item',$data);
    }
      
    /************** idnex ************************/
    //index : page par defaut
    /**
     *1.data: trouver
     * 2.data: compter
     *  stocker dans un tableau info : data trouver et data compter
      **/
    public function index()      
    {
         //query the database and sort results
        $data = $this->Item->find('all', array('order' =>'year'));
        
        //get a count from the database
        $count = $this->Item->find('count');
        
        //set variables
        $info= array('items' =>$data,
            'count' =>$count);
        
        //pas variables to template
        $this->set($info);
        
    }
}

?>
