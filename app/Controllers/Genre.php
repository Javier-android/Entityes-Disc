<?php namespace App\Controllers;

use App\Models\GenresModel;

class Genre extends BaseController
{
	public function index()
	{
		$gm = new GenresModel();
		$result = $genreModel->find();
		//$data['genres']= $result; 
		//return view("inicio",$data);
		//echo var_dump($result);
		//echo var_dump($result);
		
		//echo "Estamos dentro de controlador Genre en la funcion index()";
		
		$parse = \Config\Services::parser();
		echo $parse->setData(['genres'=>$result,'base_url'=>base_url()])->render('inicio');
		
	}
	
	public function new()
	{
		//$data['tipo']='nuevo';
		//$data['opcion']=1;
	//return view("nuevo", $data);
	
	$parse = \Config\Services::parser();
	$data['titulo']='New Genre';
	$data['base_url'] = base_url();
	echo $parse->setData($data)
				->render('nuevo');
	}
	
	public function save(){
		if ($this->request->getMethod() === 'post' &&
			$this->validate(['name'=> 'required|min_length[3]|max_length[255]',])
			)
		{
		$name = $this->request->getPost('name');
		$gm = new GenresModel();
		$gm->save(['name'=>$name])
		$this->response->redirect('index');
		}else{
			echo'Verifique datos';
		}
		
	}
	
	public function edit($id){
		
		$gm = new GenresModel();
		$gr = $gm->find($id);
		$name = $gr->name;
		
		$parse = \Config\Services::parser();
		echo $parse->setData(['titulo'=>'Edit Genre','id'=>$id,'name'=>$name,'base_url'=>base_url()])
					->render('edit');
	}
	
	public function update(){
		if ($this->request->getMethod() === 'post' &&
			$this->validate(['name'=> 'required|min_length[3]|max_length[255]',
							'id'=>'required|integer'])
			)
		{
		$id = $this->request->getPost('id');
		$name = $this->request->getPost('name');
		
		$gm = new GenresModel();
		//$gr = $gm->find($id);
		//$gr->name = $name;
		
		//$gm->save($gr);
		$gm->update($id,['name'=>$name,]);
		$this->response->redirect(base_url().'/disco/public/genre');
		//echo "Se va a Guardar";
		}else{
			echo'Verifique datos';
		}
		
	}
	
	public function delete($id){
		$gm =  new GenresModel();
		$gm->delete($id);
		
		$this->response->redirect(base_url().'/disco/public/genre');
		
	}
	
	public function genresjs()
	{
		if($this->request->isAjax())
		{
			$gm = new GenresModel();
			$result = $genreModel->find();
			return json_encode(["data"=>$result]);
		}else{
			$this->response->redirect(base_url().'/disco/public/genre');
		}
	}
}