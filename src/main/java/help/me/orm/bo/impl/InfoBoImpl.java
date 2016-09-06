package help.me.orm.bo.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.bo.IInfoBo;
import help.me.orm.dao.IDao;
import help.me.orm.dao.impl.InfoDaoImpl;
import help.me.orm.entity.Info;

@Repository("infoBo")
public class InfoBoImpl implements IInfoBo {
	
	@Autowired
	InfoDaoImpl dao;

	@Override
	public IDao<Info> getDao() {
		return dao;
	}
}
