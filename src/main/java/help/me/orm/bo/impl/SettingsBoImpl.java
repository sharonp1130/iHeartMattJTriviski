package help.me.orm.bo.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.bo.ISettingsBo;
import help.me.orm.dao.IDao;
import help.me.orm.dao.impl.SettingsDaoImpl;
import help.me.orm.entity.Settings;

@Repository("settingsBo")
public class SettingsBoImpl implements ISettingsBo {
	@Autowired
	SettingsDaoImpl dao;

	@Override
	public IDao<Settings> getDao() {
		return dao;
	}

}
