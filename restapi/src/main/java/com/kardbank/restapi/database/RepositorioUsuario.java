package com.kardbank.restapi.database;

import com.kardbank.restapi.entidade.Usuario;

import org.springframework.data.jpa.repository.JpaRepository;

public interface RepositorioUsuario extends JpaRepository<Usuario,Long>{
    
}
