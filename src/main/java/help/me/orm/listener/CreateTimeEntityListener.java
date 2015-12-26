package help.me.orm.listener;

import java.util.Date;
import java.util.Map;

import org.hibernate.HibernateException;
import org.hibernate.event.spi.PersistEvent;
import org.hibernate.event.spi.PersistEventListener;
import org.hibernate.event.spi.PreInsertEvent;
import org.hibernate.event.spi.PreInsertEventListener;
import org.hibernate.event.spi.SaveOrUpdateEvent;
import org.hibernate.event.spi.SaveOrUpdateEventListener;
import org.springframework.stereotype.Component;

import help.me.orm.entity.User;

/**
 * On persist this will set the create time on an object.
 * @author triviski
 *
 */
@Component
@SuppressWarnings("serial")
public class CreateTimeEntityListener implements PreInsertEventListener, PersistEventListener, SaveOrUpdateEventListener {

	@Override
	public boolean onPreInsert(PreInsertEvent event) {
		Object eventObj = event.getEntity();
		
		if (eventObj instanceof User) {
			((User)eventObj).setCreatedAt(new Date());
		}
		
		return false;
	}

	@Override
	public void onPersist(PersistEvent event) throws HibernateException {
		// TODO Auto-generated method stub
		Object eventObj = event.getObject();
		
		if (eventObj instanceof User) {
			((User)eventObj).setCreatedAt(new Date());
		}
	}

	@Override
	public void onPersist(PersistEvent event, Map createdAlready) throws HibernateException {
		// TODO Auto-generated method stub
		Object eventObj = event.getObject();
		
		if (eventObj instanceof User) {
			((User)eventObj).setCreatedAt(new Date());
		}

		
	}

	@Override
	public void onSaveOrUpdate(SaveOrUpdateEvent event) throws HibernateException {
		Object eventObj = event.getObject();
		
		if (eventObj instanceof User) {
			((User)eventObj).setCreatedAt(new Date());
		}
		
	}

}
