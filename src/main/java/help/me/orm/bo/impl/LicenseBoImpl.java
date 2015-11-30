package help.me.orm.bo.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.bo.ILicenseBo;
import help.me.orm.dao.IDao;
import help.me.orm.dao.ILicenseDao;
import help.me.orm.entity.License;

@Repository("licenseBo")
public class LicenseBoImpl implements ILicenseBo {
	@Autowired
	ILicenseDao dao;
	
	@Override
	public IDao<License> getDao() {
		return dao;
	}

}
