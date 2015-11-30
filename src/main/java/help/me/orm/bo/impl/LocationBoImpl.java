package help.me.orm.bo.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.bo.ILocationBo;
import help.me.orm.dao.IDao;
import help.me.orm.dao.impl.LocationDaoImpl;
import help.me.orm.entity.Location;

@Repository("locationBo")
public class LocationBoImpl implements ILocationBo {
	@Autowired
	LocationDaoImpl dao;

	@Override
	public IDao<Location> getDao() {
		return dao;
	}
}
